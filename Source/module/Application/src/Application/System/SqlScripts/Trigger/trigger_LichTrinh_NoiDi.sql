-- Phong

Create trigger trig_LichTrinh_NoiDi on LichTrinh for insert, update
as
	if not exists(select * from TinhThanh tt, inserted i where tt.TenTinh = i.NoiDi)
	begin
		raiserror(N'Tỉnh thành nơi đi không tồn tại!',16,1)
		rollback
	end