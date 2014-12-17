-- Thêm một xe mới
--
-- usp_createCar '43X-3432', 1, 'TABU', 'F59C381'

Create Procedure usp_createCar
	@id varchar(10),
	@type int,
	@operator nchar(10),
	@route nchar(10)
As
Begin
	Insert Into Xe(BangSoXe, LoaiXe, HangXe, LichTrinh)
	Values(@id, @type, @operator, @route)
End