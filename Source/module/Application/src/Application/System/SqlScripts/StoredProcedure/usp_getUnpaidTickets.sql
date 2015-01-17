-- lấy danh sách vé chưa thanh toán theo khách hàng
--
-- usp_getUnpaidTickets '025022111'

Create Procedure usp_getUnpaidTickets
	@customer varchar(10)
As
Begin
	Select MaVe, lich.NoiDi, lich.NoiDen, ticket.NgayDi, hang.TenHangXe, ticket.ViTri, ticket.GiaVe, ticket.TinhTrang
	From ((Ve ticket join Xe car on ticket.Xe = car.BangSoXe) join LichTrinh lich on car.LichTrinh = lich.MaLT) join HangXe hang on car.HangXe = hang.MaHangXe
	Where ticket.KhachHang = @customer And ticket.TinhTrang = 'Unpaid'
End