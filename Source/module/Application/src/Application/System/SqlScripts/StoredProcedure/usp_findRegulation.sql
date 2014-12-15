-- Tìm kiếm sự kiện điều tiết giá vé theo một tiêu chí nào đó
--
-- usp_findRegulation 'MaDT', 'DG2014'

Create Procedure usp_findRegulation
	@condition varchar(15),
	@key nvarchar(50)
As
Begin
	Declare @sqlStr nvarchar(500)

	If @condition = 'MaDT' Or @condition = 'LyDo'
	Begin
		Set @sqlStr = 'Select MaDT, NgayBatDau, NgayKetThuc, PhanTram, Lydo ' +
						'From DieuTietGiaVe ' +
						'Where ' + @condition + ' Like N''%' + @key + '%'''
	End
	Else If @condition = 'NgayBatDau' Or @condition = 'NgayKetThuc'
	Begin
		Set @sqlStr = 'Select MaDT, NgayBatDau, NgayKetThuc, PhanTram, LyDo ' +
						'From DieuTietGiaVe ' +
						'Where ' + @condition + ' = Convert(Date, ''' + @key + ''', 103)'
	End
	Else If @condition = 'PhanTram'
	Begin
		Set @sqlStr = 'Select MaDT, NgayBatDau, NgayKetThuc, PhanTram, LyDo ' +
						'From DieuTietGiaVe ' +
						'Where ' + @condition + ' = ' + @key
	End

	Exec sp_executesql @sqlStr
End