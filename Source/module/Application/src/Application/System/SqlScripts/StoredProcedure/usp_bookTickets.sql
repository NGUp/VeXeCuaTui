-- Đặt vé cho một người dùng, người dùng có thể đặt nhiều vé cùng lúc
--
-- usp_bookTickets '43JHK24O', N'SIDA', '115', 'ABC@gmail.com', '19,25,','A2E86F0', '43H-343.23'

Create Procedure usp_bookTickets
	@customerId nchar(10),
	@name nvarchar(50),
	@phone varchar(15),
	@email varchar(50),
	@seats varchar(255),
	@route varchar(10),
	@car varchar(10)
As
Begin
	Begin Tran
	Begin Try

		Declare @position int,
				@seat int

		WHILE CHARINDEX(',', @seats) > 0
		BEGIN
			Set @position  = CHARINDEX(',', @seats)
			Set @seat = SUBSTRING(@seats, 1, @position - 1)

			exec usp_bookTicket @car, @route, @customerId, @seat

			Set @seats = SUBSTRING(@seats, @position + 1, LEN(@seats)- @position)
		END

		Insert Into KhachHang(MaKH, HoTen, Email, DienThoai)
		Values(@customerId, @name, @email, @phone)

		Commit
	End Try
	Begin Catch
		Rollback Tran
	End Catch
End