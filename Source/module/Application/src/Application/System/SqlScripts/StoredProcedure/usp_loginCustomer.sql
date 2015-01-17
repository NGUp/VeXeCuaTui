-- Khách hàng đăng nhập
--
-- usp_loginCustomer '025022111', '4297f44b13955235245b2497399d7a93'

Create Procedure usp_loginCustomer
	@id varchar(10),
	@pass varchar(50)
As
Begin
	Declare @hash varchar(50)

	Set @hash = dbo.uf_encodePassword(@id, @pass, NULL)

	Select MaKH, HoTen, Email, DienThoai
	From KhachHang
	Where MaKH = @id And MatKhau = @hash
End