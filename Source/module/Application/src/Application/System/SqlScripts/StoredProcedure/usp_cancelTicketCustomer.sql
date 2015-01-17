-- Hủy vé đã đặt
--
-- usp_cancelTicketCustomer '8121FC3'

Create Procedure usp_cancelTicketCustomer
	@ticket varchar(10)
As
Begin
	Declare @car varchar(10),
			@route varchar(10),
			@seat int,
			@date varchar(10)

	Select @car = Xe, @seat = ViTri, @date = NgayDi
	From Ve
	Where MaVe = @ticket

	Select @route = lich.MaLT
	From Xe car join LichTrinh lich on car.LichTrinh = lich.MaLT
	Where BangSoXe = @car And lich.NgayDi = @date

	exec usp_removeTicket @ticket, @car, @route, @seat
End