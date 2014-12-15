-- Lấy toàn bộ danhs sách các Lịch trình

-- usp_findAllRoute

Create Procedure usp_findAllRoute
As
Begin
	Select MaLT, GioDi, NgayDi, NoiDi, NoiDen, GiaVe, CacDiemDung
	From LichTrinh
End