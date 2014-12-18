-- Tìm kiếm Xe theo tiêu chí nào đó
--
-- usp_findCars 'BangSoXe', '98D-2312'

Create Procedure usp_findCars
	@condition nvarchar(50),
	@key nvarchar(50)
As
Begin
	Declare @sqlStr nvarchar(500)

	If @condition = 'BangSoXe'
	Begin
		Set @sqlStr = '
			Select xe.BangSoXe, loai.TenLoai, hang.TenHangXe, lich.NoiDi, lich.NoiDen
			From (Xe xe join LichTrinh lich On xe.LichTrinh = lich.MaLT) join LoaiXe loai on xe.LoaiXe = loai.MaLoai, HangXe hang
			Where hang.MaHangXe = xe.HangXe And Xe.BangSoXe = ''' + @key + '''
		'
	End

	exec sp_executesql @sqlStr
End