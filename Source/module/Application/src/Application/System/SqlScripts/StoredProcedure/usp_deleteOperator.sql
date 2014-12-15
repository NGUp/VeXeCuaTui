-- Xóa một Hãng xe
--
-- usp_deleteOperator 'MLE'

Create Procedure usp_deleteOperator
	@id nchar(10)
As
Begin
	Delete From HangXe
	Where MaHangXe = @id
End