-- Tìm kiếm các Lịch trình theo các tiêu chí
--
-- usp_findRoutes 'TramDung', N'Lào Cai'

Create Procedure usp_findRoutes
	@condition varchar(10),
	@key nvarchar(50)
As
Begin
	Declare @query nvarchar(255)

	If @condition = 'MaLT'
	Begin
		Set @query =
		    'Select MaLT, MaHangXe, NgayDi, GioDi, NoiDi, NoiDen, GiaVe, CacDiemDung ' +
			'From LichTrinh ' +
			'Where MaLT = ''' + @key + ''''
	End
	Else If @condition = 'Tuyen'
	Begin
		Set @query =
			'Select MaLT, MaHangXe, NgayDi, GioDi, NoiDi, NoiDen, GiaVe, CacDiemDung ' +
			'From LichTrinh ' +
			'Where NoiDi = N''' + @key + ''' Or NoiDen = N''' + @key + ''''
	End
	Else If @condition = 'ThoiGian'
	Begin
		Declare @date varchar(10),
				@_date datetime

		Set @_date = CAST(@key as datetime)
		Set @date = CONVERT(VARCHAR(10), @_date, 101)

		Set @query =
			'Select MaLT, MaHangXe, NgayDi, GioDi, NoiDi, NoiDen, GiaVe, CacDiemDung ' +
			'From LichTrinh ' +
			'Where NgayDi = ''' + @date + ''' Or GioDi = ''' + @key + ''''
	End

	Exec sp_executesql @query
End