-- Hủy một vé
--
-- usp_removeTicket '1937349', '43H-343.23', 'A2E86F0', '1,'

Create Procedure usp_removeTicket
	@ticket varchar(10),
	@car varchar(10),
	@route varchar(10),
	@seat varchar(3)
As
Begin
	Declare @seats varchar(255),
			@result varchar(255),
			@position int

	Select @seats = ghe.GheDaDat
	From GheDaDat ghe
	Where ghe.Xe = @car And ghe.LichTrinh = @route

	Set @position = CHARINDEX(@seat, @seats)
	Set @result = SUBSTRING(@seats, 1, @position - 1)
	Set @result = @result + SUBSTRING(@seats, @position + LEN(@seat), LEN(@seats))

	If @result = '' Or @result = NULL
	Begin
		Delete From GheDaDat
		Where Xe = @car And LichTrinh = @route
	End
	Else
	Begin
		Update GheDaDat
		Set GheDaDat = @result
		Where Xe = @car And LichTrinh = @route
	End

	Delete From Ve
	Where MaVe = @ticket
End