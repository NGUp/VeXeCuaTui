-- Tìm kiếm chuyến đi
--
-- usp_findTrip 54, 1, '24/12/2014'

Create Procedure usp_findTrip
	@_from int,
	@_to int,
	@date varchar(15)
As
Begin
	Declare @from nvarchar(50),
			@to nvarchar(50),
			@_date datetime

	Select @from = TenTinh
	From TinhThanh
	Where MaTinh = @_from

	Select @to = TenTinh
	From TinhThanh
	Where MaTinh = @_to

	Set @_date = CAST(@date as datetime)
	Set @date = CONVERT(VARCHAR(10), @_date, 103)

	Select TenHangXe, NoiDi, NoiDen, GioDi, TenLoai, Gia, BangSoXe, MaLT, NgayDi
	From ((Xe car join LichTrinh lich on car.LichTrinh = lich.MaLT) join HangXe hang on car.HangXe = hang.MaHangXe) join LoaiXe loai on car.LoaiXe = loai.MaLoai
	Where car.HangXe = lich.MaHangXe And NoiDi = @from And NoiDen = @to And NgayDi = @date
End