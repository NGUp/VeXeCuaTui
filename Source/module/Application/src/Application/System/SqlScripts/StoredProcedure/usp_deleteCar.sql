-- Xóa một xe
--
-- usp_deleteCar '73M-3443'

Create Procedure usp_deleteCar
	@car varchar(10)
As
Begin
	Delete From GheDaDat Where Xe = @car
	Delete From Ve Where Xe = @car
	Delete From Xe Where BangSoXe = @car
End