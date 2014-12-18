-- Cập nhật Xe
--
-- usp_updateCar '43X-3432', 2, 'FAKE', 'A2E86F0'

Create Procedure usp_updateCar
	@id varchar(10),
	@type int,
	@route nchar(10)
As
Begin
	Update Xe
	Set LoaiXe = @type,
		LichTrinh = @route
	Where BangSoXe = @id
End