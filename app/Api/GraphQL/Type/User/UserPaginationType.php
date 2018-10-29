<?php
	/**
	 * Created by PhpStorm.
	 * User: fabrizio
	 * Date: 25/10/18
	 * Time: 22.18
	 */

	namespace App\Api\GraphQL\Type\User;

	use GraphQL;
	use GraphQL\Type\Definition\Type;
	use Folklore\GraphQL\Support\Type as GraphQLType;
	use Illuminate\Pagination\LengthAwarePaginator;

	class UserPaginationType extends GraphQLType
	{

		protected $attributes = [
			'name' => 'UserPagination',
			'description' => 'User with paginate',
			'uri' => 'query=query{usersPagination(perPage:15,page:1){user{id,name},meta{total}}}'
		];

		public function fields()
		{
			return [
				'user' => [
					'type' => Type::listOf(GraphQL::type('User')),
					'resolve' => function ($root) {
						return $root;
					}
				],
				'meta' => [
					'type' => Type::nonNull(GraphQL::type('PaginationMeta')),
					'resolve' => function (LengthAwarePaginator $paginator) {
				return $paginator->toArray();
					},
				]
			];
		}
	}