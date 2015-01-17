-- Đặt một vé
--
-- usp_bookTicket '43H-343.23', '025022111', 7

Create Procedure usp_bookTicket
	@car varchar(10),
	@route varchar(10),
	@customer nchar(10),
	@seat int
As
ALTER Procedure [dbo].[usp_bookTicket]
	@car varchar(10),
	@route varchar(10),
	@customer nchar(10),
	@seat int
As
Begin
	Begin Try
		Declare @id nchar(10),
				@seats varchar(255),
				@percent int,
				@price int,
				@sum int,
				@date varchar(10)

		Set @id = CONVERT(NVARCHAR(50),HashBytes('SHA1', Cast(GETDATE() as varchar(30)) + CAST(RAND() as varchar(30))), 2)
		Set @id = SUBSTRING(@id, 1, 7)

		Select @price = Gia
		From Xe car
		Where car.BangSoXe = @car

		Declare cur Cursor For
			Select PhanTram
			From DieuTietGiaVe dieuTiet
			Where GETDATE() Between dieuTiet.NgayBatDau And dieuTiet.NgayKetThuc

		Set @sum = 0

		Open cur

		Fetch Next From cur Into @percent
		While @@FETCH_STATUS = 0
		Begin
			Set @sum = @sum + @percent

			Fetch Next From cur Into @percent
		End

		Close cur
		Deallocate cur

		If @sum < 0
		Begin
			Set @price = @price - (@price * (@sum * -1) / 100)
		End
		Else
		Begin
			Set @price = @price + (@price * @sum / 100)
		End

		Select @date = lich.NgayDi
		From LichTrinh lich
		Where lich.MaLT = @route

		Insert Into Ve(MaVe, NgayDangKy, ViTri, Xe, KhachHang, TinhTrang, GiaVe, NgayDi)
		Values(@id, CONVERT(VARCHAR(10), GETDATE(), 103), @seat, @car, @customer, 'Unpaid', @price, @date)

		Select @seats = GheDaDat
		From GheDaDat ghe
		Where ghe.Xe = @car And ghe.LichTrinh = @route

		If ISNULL(@seats, '-1') = '-1'
		Begin
			Insert Into GheDaDat(Xe, LichTrinh, GheDaDat)
			Values(@car, @route, Cast(@seat as varchar(2)) + ',')
		End
		Else
		Begin
			Update GheDaDat
			Set GheDaDat = @seats + Cast(@seat as varchar(2)) + ','
			Where Xe = @car And LichTrinh = @route
		End
	End Try
	Begin Catch
		Rollback
	End Catch
End