-- Đặt một vé
--
-- usp_bookTicket '43H-343.23', '025022111', 7

Create Procedure usp_bookTicket
	@car varchar(10),
	@route varchar(10),
	@customer nchar(10),
	@seat int
As
Begin
	Declare @id nchar(10),
			@seats varchar(255)

    Set @id = CONVERT(NVARCHAR(50),HashBytes('SHA1', Cast(GETDATE() as varchar(30)) + CAST(RAND() as varchar(30))), 2)
    Set @id = SUBSTRING(@id, 1, 7)

	Insert Into Ve(MaVe, NgayDangKy, ViTri, Xe, KhachHang, TinhTrang)
	Values(@id, CONVERT(VARCHAR(10), GETDATE(), 103), @seat, @car, @customer, 'Unpaid')

	Select @seats = GheDaDat
	From GheDaDat ghe
	Where ghe.Xe = @car And ghe.LichTrinh = @route

	If @seats = NULL
	Begin
		Update GheDaDat
		Set GheDaDat = Cast(@seat as varchar(2)) + ','
		Where Xe = @car And LichTrinh = @route
	End
	Else
	Begin
		Update GheDaDat
		Set GheDaDat = @seats + Cast(@seat as varchar(2)) + ','
		Where Xe = @car And LichTrinh = @route
	End
End
