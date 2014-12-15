-- Cập nhật thông tin Quản trị viên
--
-- usp_updateManager '456874893', 'asdas', 'asdas', 'hoydinha', 'False', N'Hoàng Long Asia'

Create Procedure usp_updateManager
	@id nchar(10),
	@name nvarchar(50),
	@user varchar(50),
	@pass varchar(50),
	@isAdmin char(3),
	@operator nchar(10)
As
Begin
	Declare @status bit

	If @isAdmin Is Not Null
	Begin
		Set @status = 'True'
		Set @operator = NULL
	End
	Else
		Set @status = 'False'

	Update QuanTriVien
	Set HoTen = @name,
		TenDangNhap = @user,
		MatKhau = dbo.uf_encodePassword(@user, @pass, Null),
		QuanTriVien = @status,
		HangXe = @operator
	Where CMND = @id
End
