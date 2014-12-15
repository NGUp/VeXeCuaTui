-- cập nhật lại lịch trình
--
-- usp_updateRoute '84A7CFC', '09/12/2014', '12:28 PM', N'Hà Giang', N'Kon Tum', 200000, N'Bình Dương,Thừa Thiên - Huế,Trà Vinh'

Create Procedure usp_updateRoute
	@id nchar(10),
	@date varchar(15),
	@time varchar(10),
	@start_location nvarchar(50),
	@end_location nvarchar(50),
	@price int,
	@stop nvarchar(255)
As
Begin
	Update LichTrinh
	Set NgayDi = @date,
		GioDi = @time,
		NoiDi = @start_location,
		NoiDen = @end_location,
		GiaVe = @price,
		CacDiemDung = @stop
	Where MaLT = @id
End