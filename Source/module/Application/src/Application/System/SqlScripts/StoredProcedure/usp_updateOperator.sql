-- Cập nhật Hãng xe
--
-- usp_updateOperator 'MLE', 'Mai Linh', 'mai_linh.png'

Create Procedure usp_updateOperator
	@id nchar(10),
	@name nvarchar(50),
	@logo nvarchar(100)
As
Begin
	Update HangXe Set TenHangXe = @name, Logo = @logo Where MaHangXe = @id
End