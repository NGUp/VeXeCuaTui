-- Lấy danh sách lộ trình theo mã hãng xe
--
-- usp_getRoutesByOperator 'FUTA'

Create Procedure usp_getRoutesByOperator
	@operator varchar(10)
As
Begin
	Select MaLT, GioDi, NgayDi, NoiDi, NoiDen, GiaVe, CacDiemDung
	From LichTrinh
	Where MaHangXe = @operator
End