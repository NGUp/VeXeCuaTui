Create Trigger trigger_them_sua_HangXe_QuanTriVien On QuanTriVien For Insert, Update
As
	If (update(HangXe))
	Begin
		Declare @operator varchar(10)

		Select @operator = HangXe
		From Inserted

		If (Select Count(*) From QuanTriVien Where HangXe = @operator) > 1
		Begin
			Raiserror(N'Mỗi hãng xe chỉ có một quản trị viên duy nhất', 16, 1)
			Rollback
		End
	End