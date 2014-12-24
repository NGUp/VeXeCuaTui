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
			@to nvarchar(50)

	Select @from = TenTinh
	From TinhThanh
	Where MaTinh = @_from

	Select @to = TenTinh
	From TinhThanh
	Where MaTinh = @_to

	Select TenHangXe, NoiDi, NoiDen, GioDi, LoaiXe, Gia
	From (HangXe hang join LichTrinh lich on hang.MaHangXe = lich.MaHangXe) join Xe car on car.LichTrinh = lich.MaLT
	Where NoiDi = @from And NoiDen = @to And NgayDi = @date
End