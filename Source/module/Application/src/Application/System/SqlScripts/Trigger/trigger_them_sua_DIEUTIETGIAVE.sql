Create Trigger trigger_them_sua_DIEUTIETGIAVE On DieuTietGiaVe For Insert, Update
As
	Declare @from date,
			@to date

	Select @from = NgayBatdau, @to = NgayKetThuc
	From Inserted

	If DATEDIFF(day, @from, @to) < 0
	Begin
		Raiserror(N'Ngày bắt đầu phải sớm hơn hoặc trùng với ngày kết thúc', 16, 1)
		Rollback
	End