<?php


namespace App\Controller\Admin;


use App\Entity\Post;

use App\Form\PostType;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\PostRepositoryInterface;
use App\Service\Post\PostServiceInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminPostController extends AdminBaseController
{
    private $categoryRepository;

    private $postRepository;
    /**
     * @var PostServiceInterface
     */
    private $postService;

    /**
     * AdminPostController constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     * @param PostRepositoryInterface $postRepository
     * @param PostServiceInterface $postService
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository,
                                PostRepositoryInterface $postRepository, PostServiceInterface $postService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
        $this->postService = $postService;
    }

    /**
     * @Route("/admin/post", name="admin_post")
     */
    public function index()
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Посты';
        $forRender['post'] = $this->postRepository->getAll();
        $forRender['checkCategory'] = $this->categoryRepository->getAll();

        return $this->render('admin/post/index.html.twig', $forRender);
    }

    /**
     * @Route("/admin/post/create", name="admin_post_create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->postService->handleCreate($form, $post);
            $this->addFlash('success', 'Пост добавлен');
            return $this->redirectToRoute('admin_post');
        }
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Создание поста';
        $forRender['form'] = $form->createView();

        return $this->render('admin/post/form.html.twig', $forRender);
    }

    /**
     * @Route("/admin/post/update/{postId}", name="admin_post_update")
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function update(int $postId, Request $request)
    {
        /** @var Post $post */
        $post = $this->postRepository->getOne($postId);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if($form->get('save')->isClicked()) {
                $this->postService->handleUpdate($form, $post);
                $this->addFlash('success', 'Пост обновлен');

            }
            if($form->get('delete')->isClicked()) {
                $this->postService->handleDelete($post);
                $this->addFlash('success', 'Пост удален');
            }

            return $this->redirectToRoute('admin_post');

        }
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Редактирование поста';
        $forRender['form'] = $form->createView();

        return $this->render('admin/post/form.html.twig', $forRender);

    }
}