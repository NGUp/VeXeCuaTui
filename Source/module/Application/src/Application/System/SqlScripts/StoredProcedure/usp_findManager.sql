-- Tìm kiếm Quản trị viên theo điều kiện
--
-- usp_findManager 'CMND', '025022111'
-- usp_findManager 'HoTen', N'Tèo'

Create Procedure usp_findManager
	@condition varchar(15),
	@key nvarchar(50)
As
Begin
	Declare @sqlStr nvarchar(255)

	If @condition = 'HoTen'
	Begin
		Set @sqlStr = 'Select qtv.CMND, qtv.HoTen, qtv.TenDangNhap, qtv.QuanTriVien, hx.TenHangXe, hx.MaHangXe' +
						'From QuanTriVien qtv Left Join HangXe hx on qtv.HangXe = hx.MaHangXe ' +
						N'Where qtv.HoTen Like N''%' + @key + '%'''
	End
	Else If @condition = 'TenHangXe'
	Begin
		Set @sqlStr = 'Select qtv.CMND, qtv.HoTen, qtv.TenDangNhap, qtv.QuanTriVien, hx.TenHangXe, hx.MaHangXe ' +
						'From QuanTriVien qtv Left Join HangXe hx on qtv.HangXe = hx.MaHangXe ' +
						N'Where hx.TenHangXe Like N''%' + @key + '%'''
	End
	Else If @condition = 'CMND' Or @condition = 'TenDangNhap'
	Begin
		Set @sqlStr = 'Select qtv.CMND, qtv.HoTen, qtv.TenDangNhap, qtv.QuanTriVien, hx.TenHangXe, hx.MaHangXe ' +
						'From QuanTriVien qtv Left Join HangXe hx on qtv.HangXe = hx.MaHangXe ' +
						N'Where qtv.' + @condition + ' = ''' + @key + ''''
	End

	Exec sp_executesql @sqlStr
End