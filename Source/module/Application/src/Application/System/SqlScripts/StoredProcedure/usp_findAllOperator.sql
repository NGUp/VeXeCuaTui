-- Lấy tất cả hãng xe
--
-- usp_findAllOperator

Create Procedure usp_findAllOperator
As
Begin
	Select MaHangXe, TenHangXe
	From HangXe
End