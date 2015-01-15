-- Hủy thanh toán
--
-- usp_cancelTicket '81E977D', 'A2E86F0'

Create Procedure usp_cancelTicket
	@customer varchar(10),
	@route varchar(10)
As
Begin
	Declare cur Cursor For
		Select MaVe, ViTri, Xe
		From Ve
		Where KhachHang = @customer

	Declare @ticket varchar(10),
			@seat varchar(5),
			@car varchar(10)

	Open cur

	Fetch Next From cur Into @ticket, @seat, @car
	While @@FETCH_STATUS = 0
	Begin
		Set @seat = @seat + ','
		exec usp_removeTicket @ticket, @car, @route, @seat
		Fetch Next From cur Into @ticket, @seat, @car
	End

	Close cur
	Deallocate cur

	Delete From KhachHang Where MaKH = @customer
End