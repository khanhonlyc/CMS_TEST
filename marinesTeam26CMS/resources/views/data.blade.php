@foreach ($banners as $key => $banner )
  <tr class="@if($banner->status == 1) active @else noneactive @endif">
    <td>{{ $banner->id }}</td>
    <td class="max50">{{ $banner->sort_no }}</td>
    <td width="120">
      <div class="img">
        <img src={{ $banner->image_url }} alt="">
      </div>
    </td>
    <td>
      <div class="text text-start">
        <span class="date">{{ $banner->publish_start }}　～　{{ $banner->publish_end }}</span>
        <h3><a href="{{ route('top-page-type-edit-id-put',[$banner->banner_type_code,$banner->id]) }}">{{ $banner->title }}</a></h3>
        @php
        $ftcs = $banner->fan_type_code;
        $arrftc = explode(",",$ftcs);
        @endphp
        <div class="tags">
          @foreach ( $banner->fantypenameen as  $tt)
            <span>{{ $tt->fantypename }}</span>
          @endforeach
        </div>
        <div class="time">
          <div class="time-custom">
            <span>登録日時</span>
            <p class="m-0">{{ $banner->created_at }}</p>
          </div>
          <div class="time-custom">
            <span>更新日時</span>
            <p class="m-0">{{ $banner->updated_at }}</p>
          </div>
        </div>
      </div>
    </td>
  </tr>
@endforeach
