-- Tìm kiếm Xe theo tiêu chí nào đó
--
-- usp_findCars 'BangSoXe', '98D-2312'

Create  Procedure [dbo].[usp_findCars]
	@operator varchar(10),
	@condition nvarchar(50),
	@key nvarchar(50)
As
Begin
	Declare @sqlStr nvarchar(500)

	If @condition = 'BangSoXe'
	Begin
		Set @sqlStr = '
			Select x.BangSoXe, loai.TenLoai, hang.TenHangXe, lich.NoiDi, lich.NoiDen
			From ((Xe x join LichTrinh lich On x.LichTrinh = lich.MaLT) join LoaiXe loai on x.LoaiXe = loai.MaLoai) Join HangXe hang on x.HangXe = hang.MaHangXe
			Where x.BangSoXe = ''' + @key + '''
		'
	End
	Else If @condition = 'Loai'
	Begin
		Set @sqlStr = '
			Select x.BangSoXe, loai.TenLoai, hang.TenHangXe, lich.NoiDi, lich.NoiDen
			From ((Xe x join LichTrinh lich On x.LichTrinh = lich.MaLT) join LoaiXe loai on x.LoaiXe = loai.MaLoai) Join HangXe hang on x.HangXe = hang.MaHangXe
			Where loai.TenLoai = N''' + @key + ''' And x.HangXe = ''' + @operator + '''
		'
	End
	Else If @condition = 'Tuyen'
	Begin
		Set @sqlStr = '
			Select x.BangSoXe, loai.TenLoai, hang.TenHangXe, lich.NoiDi, lich.NoiDen
			From ((Xe x join LichTrinh lich On x.LichTrinh = lich.MaLT) join LoaiXe loai on x.LoaiXe = loai.MaLoai) Join HangXe hang on x.HangXe = hang.MaHangXe
			Where (lich.NoiDi = N''' + @key + ''' Or lich.NoiDen = N''' + @key + ''') And x.HangXe = ''' + @operator + '''
		'
	End

	exec sp_executesql @sqlStr
End