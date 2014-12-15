-- Phong

Create trigger trig_LichTrinh_CacDiemDung on LichTrinh for insert, update
as
	declare @cacDiemDung nvarchar(4000)
	select @cacDiemDung = i.CacDiemDung from inserted i

	If not @cacDiemDung is null and len(@cacDiemDung) > 0
	Begin
		declare cur cursor for select * from dbo.Split(@cacDiemDung,',')

		open cur

		declare @id int, @data nvarchar(100)
		fetch next from cur into @id, @data
		while @@FETCH_STATUS = 0
		begin
			if not exists(select * from TinhThanh tt where tt.TenTinh = @data)
			begin
				raiserror(N'Các điểm dừng được nhập có điểm không tồn tại!',16,1)
				rollback
				break
			end
			fetch next from cur into @id, @data
		end

		close cur
		deallocate cur

	End