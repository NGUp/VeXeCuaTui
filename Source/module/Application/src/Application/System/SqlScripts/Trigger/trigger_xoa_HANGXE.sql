Create Trigger trigger_xoa_HANGXE On HangXe For Delete
As
	Declare @operator varchar(10)

	Select @operator = MaHangXe
	From Deleted

	Declare cur Cursor For
		Select BangSoXe
		From Xe
		Where HangXe = @operator

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

	Delete From LichTrinh Where MaHangXe = @operator
	Delete From Xe Where HangXe = @operator
	Update QuanTriVien Set HangXe = NULL Where HangXe = @operator