-- Lấy toàn bộ bảng DieuTietGiave
--
-- usp_findAllRegulation

Create Procedure usp_findAllRegulation
As
Begin
	Select MaDT, NgayBatDau, NgayKetThuc, PhanTram, LyDo
	From DieuTietGiaVe
End