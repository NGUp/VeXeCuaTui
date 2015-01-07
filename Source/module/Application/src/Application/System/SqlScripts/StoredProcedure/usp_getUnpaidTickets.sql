-- lấy danh sách vé chưa thanh toán theo khách hàng
--
-- usp_getUnpaidTickets '234F6F6'

Create Procedure usp_getUnpaidTickets
	@customer varchar(10)
As
Begin
	Select MaVe, ViTri
	From Ve
	Where KhachHang = @customer And TinhTrang = 'Unpaid'
End