<?php

namespace App\Jobs\GenerateCatalog;

class GenerateCatalogMainJob extends AbstractJob
{
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->debug('start');

        // Кеширование каталога продкутов
        GenerateCatalogCacheJob::dispatchNow();

        // Создание цепочки формирования файлов с ценами
        $chainPrices = $this->getChainPrices();

        // Основные подзадачи
        $chainMain = [
            new GenerateCategoriesJob, // Генерация категорий
            new GenerateDeliveriesJob, // Генерация способов доставки
            new GeneratePointsJob // Генерация пунктов выдачи
        ];

        // Подзадачи, которые выполняются последними
        $chainLast = [
            new ArchiveUploadsJob, // Архивирование файлов и перенос архива в публичную папку
            new SendPriceRequestJob, // Отправка уведомления стороннему сервису о том, что можно скачать новый файл архива каталога товаров
        ];

        $chain = array_merge($chainPrices, $chainMain, $chainLast);

        // Сначала выполнится, а потом запустит цепочку
        GenerateGoodsFileJob::withChain($chain)->dispatch();
        // GenerateGoodsFileJob::dispatch()->chain($chain);

        $this->debug('finish');
    }

    /**
     * Формирование цепочек подзадач по генерации файлов с ценами
     *
     * @return array
     */
    public function getChainPrices()
    {
        $result = [];
        $products = collect([1, 2, 3, 4, 5]);
        $fileNum = 1;

        foreach ($products->chunk(1) as $chunk) {
            $result[] = new GeneratePricesFileChunkJob($chunk, $fileNum);
            $fileNum++;
        }

        return $result;
    }
}
