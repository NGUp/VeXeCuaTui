-- Cập nhật thông tin Quản trị viên
--
-- usp_updateManager '012365478', 'hoydinha', '123456', '123456'

Create Procedure usp_updateManager
	@id nchar(10),
	@oldPassword varchar(50),
	@newPassword varchar(50),
	@confirmPassword varchar(50)
As
Begin
	Declare @name varchar(50)

	Select @name = TenDangNhap
	From QuanTriVien
	Where CMND = @id

	If dbo.uf_encodePassword(@name, @oldPassword, NULL) = (	Select MatKhau
																From QuanTriVien
																Where CMND = @id)
		If @newPassword = @confirmPassword
			Update QuanTriVien
			Set MatKhau = dbo.uf_encodePassword(@name, @newPassword, NULL)
			Where CMND = @id
		Else
		Begin
			Raiserror(N'Mật khẩu xác nhận không trùng khớp', 15, 1)
			Return
		End
	Else
	Begin
		Raiserror(N'Mật khẩu cũ không chính xác', 15, 1)
		Return
	End
End
