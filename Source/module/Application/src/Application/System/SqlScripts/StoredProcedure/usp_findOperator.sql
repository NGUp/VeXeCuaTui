-- Tìm Hãng xe theo mã hãng xe
--
-- usp_findOperator 'TenHangXe', 'Trang'

Create Procedure usp_findOperator
	@condition varchar(15),
	@key nvarchar(50)
As
Begin
	Declare @sqlStr nvarchar(255)

	If @condition = 'TenHangXe'
	Begin
		Set @sqlStr = 'Select MaHangXe, TenHangXe, Logo ' +
						'From HangXe ' +
						N'Where TenHangXe Like ''%' + @key + '%'''
	End
	Else If @condition = 'MaHangXe'
	Begin
		Set @sqlStr = 'Select MaHangXe, TenHangXe, Logo ' +
						'From HangXe ' +
						N'Where MaHangXe = ''' + @key + ''''
	End

	Exec sp_executesql @sqlStr
End