-- Thêm Hãng xe
--
-- usp_createOperator 'FUTA', N'Phương Trang', NULL
-- usp_createOperator 'FUTA', N'Phương Trang', 'futa.jpg'

Create Procedure usp_createOperator
	@name nvarchar(50),
	@logo nvarchar(100)
As
Begin
	Declare @id nchar(10)

    Set @id = CONVERT(NVARCHAR(50),HashBytes('SHA1', Cast(@name as varchar(30))), 2)
    Set @id = SUBSTRING(@id, 1, 7)

	Insert HangXe(MaHangXe, TenHangXe, Logo) Values(@id, @name, @logo)
End