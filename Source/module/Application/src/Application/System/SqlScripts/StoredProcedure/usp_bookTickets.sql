-- Đặt vé cho một người dùng, người dùng có thể đặt nhiều vé cùng lúc
--
-- usp_bookTickets N'Tạ Trùng Linh', '113', 'tatrunglinh@gmail.com', '19,25,', '98D-2312'

Create Procedure usp_bookTickets
	@name nvarchar(50),
	@phone varchar(15),
	@email varchar(50),
	@seats varchar(255),
	@car varchar(10)
As
Begin
    Declare @customerId nchar(10),
			@seat char(2),
			@position int

    Set @customerId = CONVERT(NVARCHAR(50),HashBytes('SHA1', Cast(SYSDATETIME() as varchar(30))), 2)
    Set @customerId = SUBSTRING(@customerId, 1, 7)

    Insert Into KhachHang(MaKH, HoTen, Email, DienThoai)
    Values(@customerId, @name, @email, @phone)

    WHILE CHARINDEX(',', @seats) > 0
	BEGIN
		Set @position  = CHARINDEX(',', @seats)
		Set @seat = SUBSTRING(@seats, 1, @position - 1)

		exec usp_bookTicket @car, @customerId, @seat

		Set @seats = SUBSTRING(@seats, @position + 1, LEN(@seats)- @position)
	END
End
