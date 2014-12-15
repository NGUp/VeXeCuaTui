-- Kiểm tra đăng nhập ở phần Quản trị viên
--
-- exec usp_login 'namvh', '8affcc78a56ab7a7564168b69fe3bdf4'

Create Procedure usp_login
	@user varchar(50),
	@pass varchar(50)
As
Begin
	Declare @hash varchar(50)

	Set @hash = dbo.uf_encodePassword(@user, @pass, NULL)

	Select HoTen, QuanTriVien, CMND, HangXe
	From QuanTriVien
	Where TenDangNhap = @user And MatKhau = @hash
End
Go
