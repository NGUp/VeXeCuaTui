-- Lấy danh sách vé theo xe
-- Trước khi thanh toán thì truy vấn câu này
-- usp_getUnpaidTicketsByCar '025022111', '43H-343.23', '17/01/2015' , '25/01/2015'

Create Procedure usp_getUnpaidTicketsByCar
	@customer varchar(10),
	@car varchar(10),
	@date_register varchar(10),
	@date_start varchar(10)
As
Begin
	Declare @_date datetime

	Select MaVe, ViTri, GiaVe
	From Ve
	Where KhachHang = @customer And TinhTrang = 'Unpaid' And Xe = @car And NgayDangKy = @date_register And NgayDi = @date_start
End