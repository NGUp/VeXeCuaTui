Create Trigger trigger_them_sua_TenDangNhap_QUANTRIVIEN On QuanTriVien For Insert, Update
As
	If (update(TenDangNhap))
	Begin
		Declare @user varchar(50)

		Select @user = TenDangNhap
		From Inserted

		If (Select Count(*) From QuanTriVien Where TenDangNhap = @user) > 1
		Begin
			Raiserror(N'Tên đăng nhập đã tồn tại', 16, 1)
			Rollback
		End
	End