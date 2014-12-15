-- Nam

Create Trigger trigger_LichTrinh_Tuyen On LichTrinh For Insert, Update
As
	Begin
		Declare @start nvarchar(50),
				@end nvarchar(50)

		Select @start = ins.NoiDi, @end = ins.NoiDen
		From Inserted ins

		If @start = @end
		Begin
			Raiserror(N'Nơi đi không được trùng với nơi đến', 15, 1)
			Rollback
		End
	End