-- Phong

Create trigger trig_LichTrinh_GiaTien on LichTrinh for insert, update
as
	declare @gia int
	select @gia = i.GiaVe from inserted i
	if @gia < 100000
	begin
		raiserror(N'Giá tiền cho lịch trình không thể ít hơn 100.000 vnđ!',16,1)
		rollback
	end