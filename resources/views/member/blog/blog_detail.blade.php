@extends('member/layout.layout')

@section('left')
@include('member/layout.left')
@endsection

@section('content')
<section>
	@if (Auth::check())
		<input type="hidden" id="user_id" value="{{ Auth::id() }}">
	@endif
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">

				</div>
			</div>
			<div class="col-sm-9">
				<div class="blog-post-area">
					<div class="single-blog-post">
						<input type="hidden" id="blog_id" value="{{ $blog->id }}">
						<h3>{{ $blog->description }}</h3>
						<div class="post-meta">
							<ul>
								<li><i class="fa fa-user"></i>{{ $blog->title }}</li>
								<li><i class="fa fa-clock-o"></i>{{ $blog->updated_at->format('H:i') }}</li>
								<li><i class="fa fa-calendar"></i>{{ $blog->updated_at->format('M d, y') }}</li>
							</ul>
							<span>
								@if ($count_rate == 0)
									{{ $avg }}
								@else
									@for ($i = 1; $i <=5; ++$i)
										@if ($i <= $avg)
											<i class="fa fa-star"></i>
										@else
											<i class=""></i>
										@endif
									@endfor
								@endif
							</span>
						</div>
						<a href="">
							<img src="{{ asset('/admin/blog/' . $blog->id . '/' . $blog->image) }}" alt="">
						</a>
						<p>{!! $blog->content !!}</p>
						<div class="pager-area">
							<ul class="pager pull-right">
								@if ($blog->id == $id_max_updated)
									<li><a href="{{ url('/member/blog_detail', ['blog_id' => $id_next]) }}">Next</a></li>
								@elseif($blog->id == $id_min_updated)
									<li><a href="{{ url('/member/blog_detail', ['blog_id' => $id_previous]) }}">Pre</a></li>
								@else
									<li><a href="{{ url('/member/blog_detail', ['blog_id' => $id_previous]) }}">Pre</a></li>
									<li><a href="{{ url('/member/blog_detail', ['blog_id' => $id_next]) }}">Next</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div><!--/blog-post-area-->
				<div class="rate">
					<div class="vote">
						@for ($i = 1; $i <= 5; ++$i)
							@if ($count_rate == 0)
								<div class="star_1 ratings_stars"><input value="{{ $i }}" type="hidden"></div>
							@else
								@if ($i <= $avg)
									<div class="star_1 ratings_stars ratings_over"><input value="{{ $i }}" type="hidden"></div>
								@else
									<div class="star_1 ratings_stars"><input value="{{ $i }}" type="hidden"></div>
								@endif
							@endif
						@endfor
						@if ($count_rate == 0)
							<span id="rate" class="rate-np">{{ $avg }}</span>
						@else
							<span id="rate" class="rate-np">Điểm trung bình: {{ $avg }}</span>
						@endif
						<br />
						<span id="count_rate" class="rate-np">Số lượt đánh giá: {{ $count_rate }}</span>
					</div>
				</div>

				<div class="response-area">
					@if ($count_comment == 0)
						<h2>Chưa có bình luận</h2>
					@else
						<h2>{{$count_comment}} bình luận</h2>
					@endif
					<ul class="media-list">
						<?php
use App\Models\member\Comment;
						?>
						@foreach ($comments as $key => $value)
							<li id="{{ $value->id }}" class="media">
								<input type="hidden" id="comment_id" value="{{ $value->id }}">
								<a class="pull-left" href="#">
									<img style="width:121px;height:86px" class="media-object"
										src="{{ asset('/member/avatar/' . $value->user_id . '/' . $value->user->avatar) }}"
										alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>{{ $value->user->name }}</li>
										<li><i class="fa fa-clock-o"></i>{{ $value->updated_at->format('H:i') }}</li>
										<li><i class="fa fa-calendar"></i>{{ $value->updated_at->format('M d, y') }}</li>
									</ul>
									<p>{{ $value->comment }}</p>
									<a class="btn btn-primary" id="show_replay_form"><i class="fa fa-reply"></i>Phản hồi</a>
									<div id="replay_form" class="text-area">
										<textarea name="message" id="replay" rows="6"></textarea>
										<a class="btn btn-primary" id="post_replay">Xác nhận</a>
									</div>
								</div>
							</li>
							@foreach (Comment::where('blog_id', $value->blog_id)->where('level', $value->id)->orderBy('updated_at', 'asc')->get() as $key1 => $value1)
								<li id="{{$value1->id}}" class="media second-media">
									<a class="pull-left" href="#">
										<img style="width:121px;height:86px" class="media-object" src="{{ asset('/member/avatar/'.$value1->user_id.'/'.$value1->user->avatar) }}" alt="">
									</a>
									<div class="media-body">
										<ul class="sinlge-post-meta">
											<li><i class="fa fa-user"></i>{{ $value1->user->name }}</li>
											<li><i class="fa fa-clock-o"></i>{{ $value1->updated_at->format('H:i') }}</li>
											<li><i class="fa fa-calendar"></i>{{ $value1->updated_at->format('M d, y') }}</li>
										</ul>
										<p>{{ $value1->comment }}</p>
									</div>
								</li>
							@endforeach
						@endforeach
					</ul>
				</div><!--/Response-area-->
				<div class="replay-box">
					<div class="row">
						<div class="col-sm-12">
							<h2>Bình luận của bạn</h2>

							<div class="text-area">
								<textarea name="message" id="comment" rows="11"></textarea>
								<a class="btn btn-primary" id="post_comment">Xác nhận</a>
							</div>
						</div>
					</div>
				</div><!--/Repaly Box-->
			</div>
		</div>
	</div>
</section>
@endsection

@section('js')
<script>

	$(document).ready(function () {
		$.ajaxSetup({
			headers: {

				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('.ratings_stars').hover(
			function () {
				$(this).prevAll().andSelf().addClass('ratings_hover');
			},
			function () {
				$(this).prevAll().andSelf().removeClass('ratings_hover');
			}
		);

		$('.ratings_stars').click(function () {
			var check_login = @json(Auth::check());
			if (!check_login) {
				alert("Vui lòng đăng nhập để tiếp tục");
			}
			else {
				var Values = $(this).find("input").val();
				var blog_id = $("input#blog_id").val();
				var user_id = $("input#user_id").val();
				var count_rate = isNaN(parseInt($("span#count_rate").text())) ? 0 : parseInt($("span#count_rate").text());
				$.ajax({
					method: "POST",
					url: "{{ url('/member/blog_detail_rate') }}",
					data: {
						blog_id: blog_id,
						user_id: user_id,
						rate: Values,
						count_rate: count_rate,
					},
					success: function (response) {
						console.log(response);
						$("span#rate").text("Đánh giá của bạn: " + response.rate);
						$("span#count_rate").text("Số lượt đánh giá: " + response.count_rate);
					}
				})
				if ($(this).hasClass('ratings_over')) {
					$('.ratings_stars').removeClass('ratings_over');
					$(this).prevAll().andSelf().addClass('ratings_over');
				} else {
					$(this).prevAll().andSelf().addClass('ratings_over');
				}
			}
		});

		$("a#post_comment").click(function () {
			var check_login = @json(Auth::check());
			if (!check_login) {
				alert("Vui lòng đăng nhập để tiếp tục");
			}
			else {
				var blog_id = $("input#blog_id").val();
				var user_id = $("input#user_id").val();
				var comment = $("textarea#comment").val();
				var level = 0;
				var count_comment = isNaN(parseInt($("div.response-area").find("h2").text())) ? 0 : parseInt($("div.response-area").find("h2").text());
				if (comment == "") {
					alert("Vui lòng nhập bình luận");
				}
				else {
					$.ajax({
						method: "POST",
						url: "{{ url('/member/blog_detail_comment') }}",
						data: {
							blog_id: blog_id,
							user_id: user_id,
							comment: comment,
							level: level,
							count_comment: count_comment,
						},
						success: function (response) {
							console.log(response);
							var avatar = "{{ asset('/member/avatar') }}" + "/" + response.user_id + "/" + response.avatar_user;
							html = `<li id="${response.comment_id}" class="media">

										<a class="pull-left" href="#">
											<img style="width:121px;height:86px" class="media-object" src="${avatar}" alt="">
										</a>
										<div class="media-body">
											<ul class="sinlge-post-meta">
												<li><i class="fa fa-user"></i>${response.name_user}</li>
												<li><i class="fa fa-clock-o"></i>${response.time}</li>
												<li><i class="fa fa-calendar"></i>${response.day}</li>
											</ul>
											<p>${response.comment}</p>
											<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Phản hồi</a>
										</div>
									</li>`;
							$("ul.media-list").append(html);
							$("textarea#comment").val("");
							$("div.response-area").find("h2").text(response.count_comment + " bình luận");
						}
					})
				}
			}
		})

		$("div#replay_form").hide();

		$("a#show_replay_form").click(function () {
			$(this).closest("li").find("div#replay_form").show();
		})

		$("a#post_replay").click(function () {
			var check_login = @json(Auth::check());
			if (!check_login) {
				alert("Vui lòng đăng nhập để tiếp tục");
			}
			else {
				var blog_id = $("input#blog_id").val();
				var user_id = $("input#user_id").val();
				var replay = $(this).closest("div#replay_form").find("textarea").val();
				var level = $(this).closest("li").find("input#comment_id").val();
				if (replay == "") {
					alert("Vui lòng nhập phản hồi");
				}
				else {
					$.ajax({
						method: "POST",
						url: "{{url('/member/blog_detail_replay')}}",
						data: {
							blog_id: blog_id,
							user_id: user_id,
							replay: replay,
							level: level,
						},
						success: function (response) {
							console.log(response);
							var avatar = "{{ asset('/member/avatar') }}" + "/" + response.user_id + "/" + response.avatar_user;
							html = `<li id="${response.replay_id}" class="media second-media">
										<a class="pull-left" href="#">
											<img style="width:121px;height:86px" class="media-object" src="${avatar}" alt="">
										</a>
										<div class="media-body">
											<ul class="sinlge-post-meta">
												<li><i class="fa fa-user"></i>${response.name_user}</li>
												<li><i class="fa fa-clock-o"></i>${response.time}</li>
												<li><i class="fa fa-calendar"></i>${response.day}</li>
											</ul>
											<p>${response.replay}</p>
										</div>
									</li>`;
							$("li#" + level).find("div#replay_form").find("textarea").val("");
							$("li#" + level).find("div#replay_form").hide();
							$("li#" + level).after(html);
							$("div.response-area").find("h2").text(response.count_comment + " bình luận");
						}
					})
				}
			}
		})
	});
</script>
@endsection