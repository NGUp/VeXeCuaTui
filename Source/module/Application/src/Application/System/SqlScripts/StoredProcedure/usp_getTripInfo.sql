-- lấy thông tin một chuyến đi bằng bảng số xe và mã chuyến đi
--
-- usp_getTripInfo 'A2E86F0', '43H-343.23'

Create Procedure usp_getTripInfo
	@trip varchar(10),
	@car varchar(10)
As
Begin
	Select TenHangXe, Logo, NgayDi, NoiDen, NoiDi, car.Gia, GheDaDat
	From ((GheDaDat ghe join Xe car on ghe.Xe = car.BangSoXe) join HangXe hang on car.HangXe = hang.MaHangXe) join LichTrinh lich on ghe.LichTrinh = lich.MaLT
	Where ghe.Xe = @car And ghe.LichTrinh = @trip
End