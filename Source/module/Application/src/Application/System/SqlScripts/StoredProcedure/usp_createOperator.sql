-- Thêm Hãng xe
--
-- usp_createOperator 'FUTA', N'Phương Trang', NULL
-- usp_createOperator 'FUTA', N'Phương Trang', 'futa.jpg'

Create Procedure usp_createOperator
	@id nchar(10),
	@name nvarchar(50),
	@logo nvarchar(100)
As
Begin
	Insert HangXe(MaHangXe, TenHangXe, Logo) Values(@id, @name, @logo)
End