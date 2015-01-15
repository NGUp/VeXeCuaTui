-- Thêm một lịch trình của một hãng xe
--
-- usp_createRoute 'Fake', '09/12/2014', '12:28 PM', N'Hà Giang', N'Kon Tum', 200000, N'Bình Dương,Thừa Thiên - Huế,Trà Vinh'

Create Procedure usp_createRoute
	@operator nchar(10),
	@date varchar(15),
	@time varchar(10),
	@start_location nvarchar(50),
	@end_location nvarchar(50),
	@price int,
	@stop nvarchar(255)
As
Begin
	Declare @id nchar(10),
			@_date datetime

    Set @_date = CAST(@date as datetime)
	Set @date = CONVERT(VARCHAR(10), @_date, 103)

	Set @id = CONVERT(NVARCHAR(50),HashBytes('SHA1', Cast(GETDATE() as varchar(30))), 2)
    Set @id = SUBSTRING(@id, 1, 7)

    Insert Into LichTrinh(MaLT, MaHangXe, NgayDi, GioDi, NoiDi, NoiDen, GiaVe, CacDiemDung)
    Values(@id, @operator, @date, @time, @start_location, @end_location, @price, @stop)
End