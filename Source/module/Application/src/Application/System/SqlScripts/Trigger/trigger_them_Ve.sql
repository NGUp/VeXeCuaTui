Create Trigger trigger_them_Ve On Ve For Insert
As
	Declare @id varchar(10),
			@date varchar(10),
			@seat int

	Select @id = Xe, @date = NgayDangKy, @seat = ViTri
	From Inserted

	If (Select Count(*) From Ve Where Xe = @id And NgayDangKy = @date And ViTri = @seat) > 1
	Begin
		Raiserror(N'Vé đã được đặt', 16, 1)
		Rollback
	End