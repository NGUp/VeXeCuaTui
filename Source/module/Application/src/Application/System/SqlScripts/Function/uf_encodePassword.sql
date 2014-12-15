-- Mã hóa password
--
-- dbo.uf_encodePassword('namvh', '9cbe9f8a653076fadeb2c952939dc499', Null)
-- dbo.uf_encodePassword('namvh', '123456', 'True')

Create Function uf_encodePassword(@user varchar(50), @hash varchar(50), @isGenerate bit)
	Returns varchar(100)
As
Begin
	Declare @result varchar(100)

	If @isGenerate Is Not Null
	Begin
		Set @result = CONVERT(NVARCHAR(50),HashBytes('SHA1', @hash), 2)
		Set @result = Lower(@result) + '0d26906343c06781b068027f55a868c4'
		Set @result = Lower(CONVERT(NVARCHAR(32),HashBytes('MD5', @result), 2))
		Set @result = @result + '8ef290b4fcbe073d33cfd1e89ab6deb0'
	End
	Else
		Set @result = @hash + '8ef290b4fcbe073d33cfd1e89ab6deb0'

	Set @result = Lower(CONVERT(NVARCHAR(50),HashBytes('SHA1', @result), 2))
	Set @result = @result + @user
	Set @result = Lower(CONVERT(NVARCHAR(32),HashBytes('MD5', @result), 2))
	Return @result
End