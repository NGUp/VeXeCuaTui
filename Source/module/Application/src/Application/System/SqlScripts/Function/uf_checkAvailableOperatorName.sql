-- Kiểm tra tên hãng xe đã tồn tại trong DB
--
-- dbo.uf_checkAvailableOperatorName(N'Cathay')

Create Function uf_checkAvailableOperatorName(@name nvarchar(50))
	Returns bit
As
Begin
	Declare @result bit

	Set @result = 'True'

	If Exists (	Select *
				From HangXe
				Where TenHangXe = @name)
		Set @result = 'False'

	Return @result
End