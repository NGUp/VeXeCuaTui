Create Trigger trigger_xoa_LICHTRINH On LichTrinh For Delete
As
	Declare @id varchar(10)

	Select @id = MaLT
	From Deleted

	Declare cur Cursor For
		Select BangSoXe
		From Xe
		Where LichTrinh = @id

	Open cur

	Declare @car varchar(10)

	Fetch Next From cur Into @car
	While @@FETCH_STATUS = 0
	Begin
		Delete From Ve Where Xe = @car

		Fetch Next From cur Into @car
	End

	Close cur
	Deallocate cur

	Update Xe Set LichTrinh = NULL Where LichTrinh = @id