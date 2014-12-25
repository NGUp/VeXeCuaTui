-- lấy thông tin một chuyến đi bằng bảng số xe và mã chuyến đi
--
-- usp_getTripInfo 'A2E86F0', '43H-343.23'

Create Procedure usp_getTripInfo
	@trip varchar(10),
	@car varchar(10)
As
Begin
	Select TenHangXe, Logo, NgayDi, NoiDen, NoiDi, Gia, DanhSachGheTrong
	From (HangXe hang join Xe car on hang.MaHangXe = car.HangXe) join LichTrinh lich on car.LichTrinh = lich.MaLT
	Where BangSoXe = @car And MaLT = @trip
End