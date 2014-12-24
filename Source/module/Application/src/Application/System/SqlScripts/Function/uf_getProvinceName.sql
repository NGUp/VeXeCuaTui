-- Lấy tên tỉnh thành khi biết mã tỉnh
--
-- dbo.uf_getProvinceName(54)

Create Function uf_getProvinceName(@id int)
	Returns nvarchar(50)
As
Begin
	Declare @name nvarchar(50)

	Select @name = TenTinh
	From TinhThanh
	Where MaTinh = @id

	Return @name
End