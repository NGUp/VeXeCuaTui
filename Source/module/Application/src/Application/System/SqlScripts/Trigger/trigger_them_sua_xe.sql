Create Trigger trigger_them_sua_Xe On Xe For Insert, Update
As
	if (update(LoaiXe) Or update(LichTrinh) Or update(Gia))
	Begin
		Declare @car varchar(10),
				@type int,
				@route varchar(10),
				@price_type int,
				@price_route int,
				@price int

		Select @car = BangSoXe, @type = LoaiXe, @route = LichTrinh From Inserted
		Select @price_type = Tien From LoaiXe Where MaLoai = @type
		Select @price_route = GiaVe From LichTrinh Where MaLT = @route
		Set @price = @price_type + @price_route

		Update Xe Set Gia = @price Where BangSoXe = @car
	End