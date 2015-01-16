-- Tạo tài khoản cho khách hàng trong hệ thông
--
-- usp_createCustomer '025022111', 'Võ Hoài Nam', 'vhnam2504@gmail.com', 'thisisapassword'

Create Procedure usp_createCustomer
	@id varchar(10),
	@name nvarchar(50),
	@email varchar(50),
	@phone varchar(15),
	@pass varchar(50)
As
Begin

    Set @pass = dbo.uf_encodePassword(@id, @pass, 'True')

    Insert Into KhachHang(MaKH, HoTen, Email, DienThoai, MatKhau)
    Values(@id, @name, @email, @phone, @pass)
End