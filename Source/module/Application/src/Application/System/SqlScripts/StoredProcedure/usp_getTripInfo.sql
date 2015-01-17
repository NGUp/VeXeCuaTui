-- lấy thông tin một chuyến đi bằng bảng số xe và mã chuyến đi
--
-- usp_getTripInfo 'A2E86F0', '43H-343.23'

Create Procedure usp_getTripInfo
	@trip varchar(10),
	@car varchar(10)
As
Begin
    Select *
    From ((Xe car join HangXe hang on car.HangXe = hang.MaHangXe) join LichTrinh lich on car.LichTrinh = lich.MaLT) left join GheDaDat ghe on car.BangSoXe = ghe.Xe
    Where car.BangSoXe = @car And lich.MaLT = @trip
End